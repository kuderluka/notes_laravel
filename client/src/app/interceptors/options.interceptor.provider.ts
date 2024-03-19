import { Provider } from '@angular/core';

import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { OptionsInterceptor } from "./options.interceptor";

export const OptionsInterceptorProvider: Provider =
  { provide: HTTP_INTERCEPTORS, useClass: OptionsInterceptor, multi: true };
