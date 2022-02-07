<template>
   <div>
    <Breadcrumb current_name="Users" ></Breadcrumb>
      <div class="row" id="table-bordered">
          <div class="col-12">
              <div class="row">

                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Total users" :total="users.length" :value="users.length" icon="fas fa-file-alt" color="primary"></StatisticsCard>
                      </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Active" :total="users.length" :value="users.length" icon="fas fa-file-alt" color="success"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Pending" :total="users.length" :value="0" icon="fas fa-file-alt" color="warning"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Trash" :total="users.length" :value="0" icon="fas fa-file-alt" color="danger"></StatisticsCard>
                      </div>
              </div>
          </div>
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h2 class="card-title">
                  <span >All Users</span>
                        <div class="mt-2">

                             <vs-input color="#7d33ff" v-model="query"  v-on:keyup="searchQuery" placeholder="Search users" />
                        </div>

                    </h2>
                      <vs-button size="large"    gradient  to="/new/article" :active="true">
                            Add User
                        </vs-button>
               </div>
               <div class="card-body">
                  <p class="card-text">

                  </p>
               </div>
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Thumbnail</th>
                           <th >Name</th>
                           <th >Plane</th>
                            <th >Email</th>
                           <th >Created</th>
                           <th >Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       <tr v-for="item in users" :key="item.id">
                                <td>
                                    <div class="d-flex justify-content-left align-items-center">
                                        <div class="avatar-wrapper">
                                        <div class="avatar me-50">
                                            <img src="/app-assets/images/avatars/1-small.png" alt="Avatar" width="32" height="32"></div>
                                        </div>
                                    </div>
                                </td>
                              <th scope="row">       <h6 class="user-name text-truncate mb-0">{{ item.name }}</h6></th>

                            <td> <p  :inner-html.prop="item.plane_id | planeStatus "></p></td>
                               <td>    <small class="text-truncate text-muted">{{ item.email }}</small></td>


                              <td> {{ item.created_at | timeformat }}</td>
                              <td>
                                <a role="button" @click="edit(item)">
                                    <i class="fas fa-edit text-primary"></i>
                                </a>
                                |
                                <a role="button"  @click="delete_Item(item)">
                                  <i class="fas fa-trash text-danger"></i>
                                </a>
                              </td>
                           </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- Bordered table end -->
   </div>
</template>
<script>
import StatisticsCard from "../components/StatisticsCard";
import Breadcrumb from "../components/Breadcrumb";
   export default {
    components:{
        StatisticsCard,
        Breadcrumb
    },
    data(){
        return {
            users:{},
            query:"",
            isloading:false,
        }
    },
    //    https://preschool.dreamguystech.com/html-template
     methods:{
           openLoading() {
          const loading = this.$vs.loading()
          setTimeout(() => {
            loading.close()
          }, 1000)
        },
             searchQuery(){

                setTimeout(() => {

                    this.findusers();
                    }, 1500)
           },

           findusers(){
                this.openLoading();
                this.getusers();
           },

                delete_Item(item){
                    Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                axios.get('/article/delete/'+item.id).then((res)=>{
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success')
                                                this.getusers();

                                });

                            }
                            })
                },
               getusers(){

                   axios.get("/user/users?query="+this.query).then((res)=>{
                       this.users=res.data.users;
                   });
               },
               edit(item){
                this.$router.push('/update/article/'+item.id);
               }
       },
       mounted(){
           this.getusers();
       }

   }
</script>
<style lang="scss" >
h4 {

    color: white;
}

.vs-input {
    border: 2px solid transparent;
    background: rgba(var(--vs-gray-2), 1);
    color: rgba(var(--vs-text), 1);
    padding: 7px 13px;
    border-radius: inherit;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    padding-left: 10px;
    width: 100% !important;
}
</style>

