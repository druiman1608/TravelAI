import { useMemo } from "react";

export const useFilter = (items, filters, filterCallback) => {
  return useMemo(() => {
    if (!items) return [];
    return items.filter(filterCallback);
  }, [items, filters, filterCallback]);
};
