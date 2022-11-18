<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Connexion</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Page de connexion</ion-title>
        </ion-toolbar>
      </ion-header>
      
      <ion-item>
        <ion-label position="floating">Email</ion-label>
        <ion-input type="text" v-model="Email"></ion-input>
        <ion-label position="floating">Mot de passe</ion-label>
        <ion-input type="text" v-model="Password"></ion-input>
      </ion-item>
      <ion-button color="tertiary" @click="Connexion">Connexion</ion-button>
      <ion-button color="success">Déjà inscrit ?</ion-button>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent, IonItem, IonLabel, IonInput, IonButton } from '@ionic/vue';

export default defineComponent({
  components: { IonHeader, IonToolbar, IonTitle, IonContent, IonPage, IonItem, IonLabel, IonInput, IonButton},
})
</script>