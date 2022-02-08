<template>
   <div>
    <Breadcrumb current_name="Categories" ></Breadcrumb>
      <div class="row" id="table-bordered">
          <div class="col-12">
              <div class="row">

                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Total categories" :total="categories.length" :value="categories.length" icon="fas fa-file-alt" color="primary"></StatisticsCard>
                      </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Active" :total="categories.length" :value="categories.length" icon="fas fa-file-alt" color="success"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Pending" :total="categories.length" :value="0" icon="fas fa-file-alt" color="warning"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Trash" :total="categories.length" :value="0" icon="fas fa-file-alt" color="danger"></StatisticsCard>
                      </div>
              </div>
          </div>
          <vs-dialog blur v-model="modal_active" width="40%">
        <template #header>
          <h4 class="not-margin">
              Create a new category
          </h4>
        </template>




        <div class="con-form">
          <vs-input v-model="category.name" placeholder="Category Name">

          </vs-input>
            <div class="demo-inline-spacing">
                        <button type="button" class="btn btn-primary" @click="onsubmit">Submit</button>
            </div>
        </div>
      </vs-dialog>
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h2 class="card-title">
                  <span >All categories</span>
                        <div class="mt-2">

                             <vs-input color="#7d33ff" v-model="query"  v-on:keyup="searchQuery" placeholder="Search categories" />
                        </div>

                    </h2>
                      <vs-button size="large"    gradient  @click="openModal"  :active="true">
                            Add Category
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

                           <th >Created</th>
                           <th >Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       <tr v-for="item in categories" :key="item.id">
                                <td>
                                 <vs-avatar primary>
                                <template #text>
                                    {{item.name}}
                                </template>
                              </vs-avatar>
                                </td>
                              <th scope="row"> <h6 class="user-name text-truncate mb-0">{{ item.name }}</h6></th>





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
            categories:{},
            category:{},
            query:"",
            isloading:false,
            modal_active:false,
            edit_mode:false,
        }
    },

     methods:{
         onsubmit(){
             if(!this.edit_mode){
                  axios.post("/category",this.category).then(response=>{

                     this.categories.push(response.data);
                     this.category={};
                     this.modal_active=false;
                     this.edit_mode=false;
                 })
                 .catch(error=>{
                     console.log(error);
                 })
             }
             else {
                  axios.put("/category/"+this.category.id,this.category).then(response=>{

                    //  this.categories.push(response.data);
                     this.category={};
                     this.modal_active=false;
                     this.edit_mode=false;
                     this.$vs.notification({
                            position:'top-right',
                            color:'success',
                            title: 'Category Updated Successfully',
                            text: 'This Category has been updated successfully'
                        })
                 })
                 .catch(error=>{
                     console.log(error);
                 })
             }

         },
         openModal(){
             this.modal_active = true;
         },
           openLoading() {
          const loading = this.$vs.loading()
          setTimeout(() => {
            loading.close()
          }, 1000)
        },
             searchQuery(){

                setTimeout(() => {

                    this.findcategories();
                    }, 1500)
           },

           findcategories(){
                this.openLoading();
                this.getCategories();
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
                                axios.delete('/category/'+item.id).then((res)=>{
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success')
                                                this.getCategories();

                                });

                            }
                            })
                },
               getCategories(){

                   axios.get("/category?query="+this.query).then((res)=>{
                       this.categories=res.data.categories;
                   });
               },
               edit(item){
                this.category=item;
                this.modal_active=true;
                this.edit_mode=true;
               }
       },
       mounted(){
           this.getCategories();
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

