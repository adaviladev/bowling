import { ComponentCustomProperties } from 'vue'
import { Store } from 'vuex'
import { Router } from 'vue-router';
import { StoreInterface } from "@/types/StoreInterface";

declare module '@vue/runtime-core' {

  interface ComponentCustomProperties {
    $store: Store<StoreInterface>;
    $route: Router;
  }
}

declare module 'vuex' {
  export function useStore (key?: string): StoreInterface<StoreInterface>;
}