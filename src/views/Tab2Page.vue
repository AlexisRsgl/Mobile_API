<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>Inscription</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-header collapse="condense">
        <ion-toolbar>
          <ion-title size="large">Tab 2</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-item>
        <ion-label position="floating">Prénom</ion-label>
        <ion-input type="text" v-model="firstname"></ion-input>
        <ion-label position="floating">Nom</ion-label>
        <ion-input type="text" v-model="name"></ion-input>
        <ion-label position="floating">Email</ion-label>
        <ion-input type="email" v-model="email"></ion-input>
        <ion-label position="floating">Mot de passe</ion-label>
        <ion-input type="password" v-model="password"></ion-input>
        <ion-label position="floating">Confirmation du mot de passe</ion-label>
        <ion-input type="password" v-model="password_confirmation"></ion-input>
      </ion-item>
      <ion-button color="success" @click="addUser">S'inscrire</ion-button>

    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent } from '@ionic/vue';

export default defineComponent({
  name: 'Tab2Page',
  components: { IonHeader, IonToolbar, IonTitle, IonContent, IonPage }
});
</script>