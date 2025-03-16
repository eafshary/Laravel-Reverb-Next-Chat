// laravel-echo.d.ts
import Echo from "laravel-echo";

// Extend the Channel interface to include the whisper method
declare module "laravel-echo" {
  interface Channel {
    whisper(eventName: string, data: any): this;
  }
}
