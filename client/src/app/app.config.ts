import { ApplicationConfig, importProvidersFrom } from '@angular/core';
import { provideRouter } from '@angular/router';
import { routes } from './app.routes';
import { provideClientHydration } from '@angular/platform-browser';
import { HttpClientModule, provideHttpClient, withFetch } from '@angular/common/http';
import { OptionsInterceptorProvider } from "./interceptors/options.interceptor.provider";
import { provideAnimations } from "@angular/platform-browser/animations";
import { environment } from "../environments/environment";
import {
  FacebookLoginProvider,
  GoogleLoginProvider,
  MicrosoftLoginProvider,
  SocialAuthServiceConfig
} from "@abacritt/angularx-social-login";


export const appConfig: ApplicationConfig = {
    providers: [
      provideRouter(routes),
      provideClientHydration(),
      provideHttpClient(withFetch()),
      importProvidersFrom(HttpClientModule),
      OptionsInterceptorProvider,
      provideAnimations(),
      {
        provide: 'SocialAuthServiceConfig',
        useValue: {
          autoLogin: false,
          providers: [
            {
              id: GoogleLoginProvider.PROVIDER_ID,
              provider: new GoogleLoginProvider(
                environment.google_client_id
              ),
            },
            {
              id: FacebookLoginProvider.PROVIDER_ID,
              provider: new FacebookLoginProvider(
                environment.facebook_client_id
              ),
            },
            {
              id: MicrosoftLoginProvider.PROVIDER_ID,
              provider: new MicrosoftLoginProvider(
                environment.microsoft_client_id,
              ),
            },
          ],
          onError: (err: any) => {
            console.error(err);
          }
        } as SocialAuthServiceConfig,
      }
    ]
};
