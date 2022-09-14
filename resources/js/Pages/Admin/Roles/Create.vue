<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Argon from '@/Layouts/Argon.vue';
import FooterDashboard from '@/Layouts/FooterDashboard.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
export default {
  components: {
      Argon,
      FooterDashboard,
      JetDangerButton,
      JetInput,
      JetInputError,
      JetLabel
  },
    props:['roles','data'],
  data() {
            return {
                editMode: false,
                isOpen: false,
                form: {
                    nom: null,
                },
            }
        },
        methods: {
            openModal() {
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
                this.reset();
                this.editMode=false;
            },
            reset() {
                this.form = {
                    nom: null,
                    body: null,
                }
            },
            save(data) {
                this.$inertia.post('/admin/roles/store', data)
                this.reset();
                this.closeModal();
                this.editMode = false;
            },
  },
}
    
  </script>

<template>
<Argon></Argon>
    <div class="container-fluid py-4 w-50">
        <form>
          <div class="card ml-24">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="text-primary font-bold ">Ajout Role</p>
                <a class="nav-link ml-80 mt-2" :href="route('admin.roles.index')">
                  <button type="button" class="btn bg-error text-gray-700 btn-danger  btn-sm ms-auto"> Annuler</button>
                </a>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">Informations de roles</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nom</label>
                    <input class="form-control" id="nom" v-model="form.nom" type="text" placeholder="entrer le nom du role">
                  </div>
                </div>
            </div>
          </div>
        </div>

    </form>
    <div class="col-6 text-end  p-4 justify-center ml-28">
        <button wire:click.prevent="store()" type="button" class="btn bg-gradient-primary text-white mb-0"><i class="fas fa-plus"></i>&nbsp;&nbsp;Ajouter</button>
    </div>
</div>

<!--
<div class="flex flex-col mt-20 ml-60 bg-white px-6 py-2 w-40">
    <div>
        <h2 class="text-center text-xl"> {{form.nom}}</h2>
        <form @submit.prevent="submit">
            <div class="mt-4">
                <jet-label for="nom" value="Nom Role" class="text-xl"></jet-label>
                <jet-input id="nom" type="text" class="mt-1 block w-full"
                v-model="form.nom" required autofocus autocomplete="name"></jet-input>
                <jet-input-error :message="form.errors.nom" class="mt-2"></jet-input-error>
            </div>
        </form>
        <div class="flex items-center justify-center mt-4">
            <button type="submit" class="tetx-sm btn btn-primary" :class="{'opacity-25':form.processing}"
            :disabled="form.processing">Ajouter</button>
            <jet-danger-button :href="route('admin.roles.index')" class="text-sm ml-4">
                Annuler
            </jet-danger-button>
        </div>
    </div>
</div>
-->
<FooterDashboard></FooterDashboard>
</template>

