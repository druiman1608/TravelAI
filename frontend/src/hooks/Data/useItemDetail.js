import { useQuery } from "@tanstack/react-query";
import api from "../../api/axios";

export function useItemDetail(endpoint, id) {
  const cleanEndpoint = endpoint.startsWith("/") ? endpoint : `/${endpoint}`;

  const { data: item, isLoading: loading, error } = useQuery({
    queryKey: [endpoint, id],
    queryFn: async () => {
      const res = await api.get(`${cleanEndpoint}/${id}`);
      console.log("[useItemDetail] res.data:", res.data);
      return res.data.data ?? res.data;
    },
    enabled: !!id,
    refetchInterval: 30000,
    refetchOnWindowFocus: false,
    staleTime: 30000,
  });

  return { item, loading, error };
}
