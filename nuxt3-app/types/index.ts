declare global {
  interface ValidationErrors {
    [key: string]: string[];
  }

  interface User {
    id: number;
    name: string;
    email: string;
  }

  interface ChatMessage {
    id: number;
    sender_id: number;
    receiver_id: number;
    text: string;
  }
}
