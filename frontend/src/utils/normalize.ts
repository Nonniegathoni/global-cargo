// Utility to normalize boolean-like values to a real boolean
export function normalizeBoolean(val: any): boolean {
  return val === true || val === 'true' || val === 1 || val === '1';
} 