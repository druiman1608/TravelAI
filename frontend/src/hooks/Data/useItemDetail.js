import { useLiveResource } from "../LiveResource/useLiveResource";
import api from "../../api/axios";

export function useItemDetail(endpoint, id) {
  const cleanEndpoint = endpoint.startsWith("/") ? endpoint : `/${endpoint}`;

  const {
    data: item,
    isLoading: loading,
    error,
  } = useLiveResource(
    [endpoint, id],
    async () => {
      if (!id) return null;
      const res = await api.get(`${cleanEndpoint}/${id}`);
      return res.data.data || res.data;
    },
    {
      interval: 30000,
      enabled: !!id,
    },
  );

  return { item, loading, error };
}
