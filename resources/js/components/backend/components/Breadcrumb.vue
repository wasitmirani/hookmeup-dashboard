<template>

      <section id="default-breadcrumb">
  <!-- <div class="row">
    <div class="col-sm-12">
      <div class="card">

        <div class="card-body">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
             <li class="breadcrumb-item"><router-link to="/">Home</router-link></li>
                <li class="breadcrumb-item" v-if="back_url"><router-link :to="back_url" >{{back_name}}</router-link></li>
                <li class="breadcrumb-item active" aria-current="page">{{current_name}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div> -->

  <div class="col-12 mb-4">
                <h2 class="content-header-title float-start mb-0"> {{current_name}}</h2>
                <div class="breadcrumb-wrapper">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item " style="margin-left: 20px;">
                        <router-link to="/"  >Home</router-link>
                    </li>
                   <li class="breadcrumb-item" v-if="back_url">
                       <router-link :to="back_url">
                           {{back_name}}
                      </router-link>
                    </li>
                    <li class="breadcrumb-item active">
                        <a  style="color:black;" href="#">{{current_name}}
                        </a>
                    </li>

                  </ol>
                </div>
              </div>
</section>
</template>

<script>
export default {
props:['home','current_name','back_url','back_name']
}
</script>

<style>

</style>
