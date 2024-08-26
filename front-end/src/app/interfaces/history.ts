export interface HistoryItem {
  country: number;
  city: number;
  amount_cop: number;
  temperature: number;
  currency_name: string;
  currency_symbol: string;
  current_amount: number;
  exchange_rate: number;
  created_at: string; // Puedes ajustar el tipo si usas otro formato de fecha
}
