import { useQuery } from "@tanstack/react-query";

export function useLiveResource(key, fetchFn, options = {}) {
  const { data, isLoading, isError, error } = useQuery({
    queryKey: key,
    queryFn: fetchFn,
    refetchInterval: options.interval || 60000,
    refetchOnWindowFocus: false,
    staleTime: options.interval || 60000,
    ...options,
  });

  return {
    data: data || [],
    isLoading,
    isError,
    error,
  };
}
