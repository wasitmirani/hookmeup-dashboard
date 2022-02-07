<template>
   <div>
    <Breadcrumb current_name="Articles" ></Breadcrumb>
      <div class="row" id="table-bordered">
          <div class="col-12">
              <div class="row">

                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Total Articles" :total="articles.length" :value="articles.length" icon="fas fa-file-alt" color="primary"></StatisticsCard>
                      </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Publish" :total="articles.length" :value="articles.length" icon="fas fa-file-alt" color="success"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Pending" :total="articles.length" :value="0" icon="fas fa-file-alt" color="warning"></StatisticsCard>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                          <StatisticsCard label="Trash" :total="articles.length" :value="0" icon="fas fa-file-alt" color="danger"></StatisticsCard>
                      </div>
              </div>
          </div>
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h2 class="card-title">
                  <span >All Articles</span>
                        <div class="mt-2">

                             <vs-input color="#7d33ff" v-model="query"  v-on:keyup="searchQuery" placeholder="Search Articles" />
                        </div>

                    </h2>
                      <vs-button size="large"    gradient  to="/new/article" :active="true">
                            Add Article
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
                           <th >Title</th>
                            <th >Status</th>
                            <th >Short Description</th>
                            <th >Description</th>
                            <th >Created By</th>
                            <th >Created</th>
                            <th >Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       <tr v-for="item in articles" :key="item.id">
                              <th scope="row">
                                     <a role="button" @click="edit(item)">
                                  {{ item.title }}
                                     </a>
                                  </th>

                            <td>   <a role="button" @click="edit(item)"><span class="badge rounded-pill badge-light-primary me-1 mt-2">Posted</span></a></td>
                               <td>   <a role="button" @click="edit(item)"><span >{{ item.short_description }}</span></a></td>
                              <td>
                                 <p  v-html="item.description.substring(0,50)">...</p>
                              </td>
                              <td> <span class="badge rounded-pill badge-light-warning me-1">{{ item.user.name }}</span> </td>
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
import StatisticsCard from "../../components/StatisticsCard";
import Breadcrumb from "../../components/Breadcrumb";
   export default {
    components:{
        StatisticsCard,
        Breadcrumb
    },
    data(){
        return {
            articles:{},
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

                    this.findArticles();
                    }, 1500)
           },

           findArticles(){
                this.openLoading();
                this.getArticles();
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
                                                this.getArticles();

                                });

                            }
                            })
                },
               getArticles(){

                   axios.get("/article/articles?query="+this.query).then((res)=>{
                       this.articles=res.data.articles;
                   });
               },
               edit(item){
                this.$router.push('/update/article/'+item.id);
               }
       },
       mounted(){
           this.getArticles();
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

