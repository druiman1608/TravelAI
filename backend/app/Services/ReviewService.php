<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function store(array $data): Review
    {
        return Review::create(array_merge($data, [
            'user_id' => Auth::id(),
            'status' => 'pending'
        ]));
    }

    public function handleUpdate(Review $review, array $data, $user): Review
    {
        if ($user->isAdmin() || $user->isMod()) {
            $review->status = $data['status'];
            if ($user->isAdmin()) {
                $review->comment = $data['comment'];
                $review->rating = $data['rating'];
            }
        } else {
            $review->comment = $data['comment'];
            $review->rating = $data['rating'];
            $review->status = 'pending';
        }
        $review->save();
        return $review;
    }
}