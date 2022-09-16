<script>
import Argon from '@/Layouts/Argon.vue';
import FooterDashboard from '@/Layouts/FooterDashboard.vue';
import { link } from "@inertiajs/inertia-vue3";
export default {
  components: {
      Argon,
      FooterDashboard,
      link
  },
  props:['roles','data', 'errors','users'],
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
            edit(data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
                this.openModal();
            },
            update(data) {
                data._method = 'PATCH';
                this.$inertia.post('/admin/roles/edit/' + data.id, data)
                this.reset();
                this.closeModal();
            },

        }
}
</script>
<template>
<Argon></Argon>
      <div class="row py-4 w-75 ml-80">
        <div class="col-lg-8 mb-lg-0 mb-4 ">
          <div class="card">
            <div class="card-header pb-0 px-3 ">
              <h6 class="text-primary font-bold">Informations des Gestionnaires</h6>
            </div>
            <div class="col-6 text-end mt-4 ml-24">
                <a class="btn bg-gradient-dark mb-0" :href="route('admin.gestionnaires.create')"><i class="fas fa-plus"></i>&nbsp;&nbsp;nouveau gestionnaire</a>
            </div>
            <div class="card-body pt-0 p-3" >
              <ul class="list-group"  v-for="(user,index) in users" :key="index">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg" v-if="user.is_admin == 1" >
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm font-bold">{{user.name}}</h6>
                    <span class="mb-2 text-xs">Email: <span class="text-dark font-weight-bold ms-sm-2">{{user.email}}</span></span>
                    <span class="mb-2 text-xs">Fonction: <span class="text-dark ms-sm-2 font-weight-bold">Gestionnaires</span></span>
                    <span class="text-xs"> Date d'inscription: <span class="text-dark ms-sm-2 font-weight-bold">{{user.created_at}}</span></span>
                  </div>
                  <div class="ms-auto text-end mt-4">
                    <span class="badge badge-sm border-none   text-white bg-gradient-danger" v-if="user.status == 0">desactivé</span>
                    <span class="badge badge-sm border-none  text-white bg-gradient-success" v-if="user.status == 1">activé</span>
                    <a class="btn btn-link text-warning px-3 mb-0" href="javascript:;" v-if="user.status == 0"><i class="fas fa-pencil-alt text-accent me-2" aria-hidden="true"></i>activer</a>
                    <a class="btn btn-link text-warning px-3 mb-0" href="javascript:;" v-if="user.status == 1"><i class="fas fa-pencil-alt text-warning me-2" aria-hidden="true"></i>desactiver</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-4 mt-10">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="text-primary font-bold pt-0">Taches Utilisateurs</h6>
            </div>
            <div class="card-body p-2">
              <ul class="list-group" v-for="(user,index) in users" :key="index">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg" v-if="user.is_admin == 1">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-mobile-button text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column" >
                      <h6 class="mb-1 text-slate-600 text-sm font-bold" >{{user.name}}</h6>
                      <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded  btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right text-dark" aria-hidden="true"></i></button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="mt- p-2">
          <div class="flex">
            <template v-for="(link, key) in users.links" :key="key">
              <Link
              v-if="link.url"
              :href="link.url"
               v-html="link.label"

              />
              <span v-else v-html="link.label"></span>
            </template> 
          </div>
        </div>
        <!--
       <nav aria-label="..." class="mt-4">
          <ul class="pagination">
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1">
                <i class="fa fa-angle-left"></i>
                <span class="sr-only  text-black">Previous</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active">
              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">
                <i class="fa fa-angle-right"></i>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
-->
      </div>
<FooterDashboard></FooterDashboard>
</template>

