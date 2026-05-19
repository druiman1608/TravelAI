import { useMemo } from "react";

export const useFilter = (items, filters, filterCallback) => {
  return useMemo(() => {
    if (!Array.isArray(items)) return [];
    return items.filter(filterCallback);
  }, [items, filters, filterCallback]);
};
