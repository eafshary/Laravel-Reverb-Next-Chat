import Echo from "laravel-echo";
import Pusher, { type ChannelAuthorizationCallback } from "pusher-js";

declare global {
  interface Window {
    Echo: Echo;
    Pusher: typeof Pusher;
  }
}

export default defineNuxtPlugin((_nuxtApp) => {
  window.Pusher = Pusher;

  const config = useRuntimeConfig();

  const echo = new Echo({
    broadcaster: "reverb",
    key: config.public.REVERB_APP_KEY,
    wsHost: config.public.REVERB_HOST,
    wsPort: config.public.REVERB_PORT ?? 80,
    wssPort: config.public.REVERB_PORT ?? 443,
    forceTLS: (config.public.REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],

    authorizer: (channel: any, options: any) => {
      return {
        authorize: (
          socketId: string,
          callback: ChannelAuthorizationCallback
        ) => {
          useSanctumFetch("api/broadcasting/auth", {
            method: "post",
            body: {
              socket_id: socketId,
              channel_name: channel.name,
            },
          })
            .then((response) => {
              callback(null, response);
            })
            .catch((error: Error) => callback(error, null));
        },
      };
    },
  });

  return {
    provide: { echo },
  };
});
