<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function store($data)
    {
        return Review::create(array_merge($data, [
            'user_id' => Auth::id(),
            'status' => 'pendiente'
        ]));
    }

    public function handleUpdate(Review $review, $data, $user)
    {
        if ($user->isAdmin() || $user->isMod()) {
            $review->status = $data['status'];
            if ($user->isAdmin()) {
                $review->comment = $data['comment'];
                $review->rating = $data['rating'];
            }
        } else {
            if ($data['status'] === 'borrada') {
                $review->status = 'borrada';
            } else {
                $review->comment = $data['comment'];
                $review->rating = $data['rating'];
                $review->status = 'pendiente';
            }
        }
        return $review->save();
    }
}