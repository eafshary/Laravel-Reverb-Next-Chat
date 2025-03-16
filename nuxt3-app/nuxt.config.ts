// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-04-03",
  devtools: { enabled: false },

  devServer: {
    host: process.env.NUXT_DEV_SERVER_HOST,
  },

  runtimeConfig: {
    public: {
      REVERB_APP_ID: process.env.NUXT_PUBLIC_REVERB_APP_ID,
      REVERB_APP_KEY: process.env.NUXT_PUBLIC_REVERB_APP_KEY,
      REVERB_APP_SECRET: process.env.NUXT_PUBLIC_REVERB_APP_SECRET,
      REVERB_HOST: process.env.NUXT_PUBLIC_REVERB_HOST,
      REVERB_PORT: process.env.NUXT_PUBLIC_REVERB_PORT,
      REVERB_SCHEME: process.env.NUXT_PUBLIC_REVERB_SCHEME,
    },
  },

  css: ["~/assets/css/main.css"],

  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },

  modules: ["@qirolab/nuxt-sanctum-authentication"],

  laravelSanctum: {
    apiUrl: process.env.NUXT_SANCTUM_API_URL,
    authMode: (process.env.NUXT_AUTH_MODE as "token" | "cookie") || "cookie",

    sanctumEndpoints: {
      // Endpoint to request a new CSRF token from the server
      csrf: "/sanctum/csrf-cookie",

      // Endpoint used for user authentication
      login: "/api/login",

      // Endpoint used to log out users
      logout: "/api/logout",

      // Endpoint to retrieve the currently authenticated user's data
      user: "/api/user",
    },

    redirect: {
      // Preserve the originally requested route, redirecting users there after login
      enableIntendedRedirect: false,

      // Path to redirect users when a page requires authentication
      loginPath: "/auth/login",

      // URL to redirect users to when guest-only access is required
      guestOnlyRedirect: "/dashboard",

      // URL to redirect to after a successful login
      redirectToAfterLogin: "/",

      // URL to redirect to after logging out
      redirectToAfterLogout: "/",
    },
  },
});
