<template>
  <div>
      <!-- Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

           <h4 class="card-title" v-if="!editmode">New Article</h4>
          <h4 class="card-title" v-else>Update Article</h4>
        </div>
        <div class="card-body">
        <form v-on:submit.prevent="onSubmit">
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-column">Article Title</label>
                  <input
                    type="text"
                    id="first-name-column"
                    class="form-control"
                    placeholder="Article Title"
                    v-model="title"
                    required
                    name="fname-column"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="last-name-column">Short Description</label>
                    <input
                    type="text"
                    id="first-name-column"
                    class="form-control"
                    required
                    placeholder="Article Short Description"
                    v-model="short_description"
                    name="fname-column"
                  />
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="mb-1">
                  <label class="form-label" for="city-column">description</label>
                  <vue-editor v-model="description" required></vue-editor>
                </div>
              </div>
            <div class="col-md-6 col-12">
                        <div class="mb-1">
                        <label class="form-label" for="last-name-column">thumbanil</label>
                               <b-form-file
                            v-model="thumbnail"
                            :state="Boolean(thumbnail)"
                            placeholder="Choose a file or drop it here..."
                            drop-placeholder="Drop file here..."
                            ></b-form-file>

                </div>
            </div>
              <div class="col-12" v-if="!editmode">
                <button type="submit" class="btn btn-primary me-1">Submit</button>
                <button type="reset" class="btn btn-outline-danger">Reset</button>
              </div>
                <div class="col-12" v-else>
                <button type="submit" class="btn btn-success me-1">Update</button>
                <button type="button" class="btn btn-outline-danger" @click="goBack">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Floating Label Form section end -->
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
export default {
components: {
       VueEditor
  },
    data(){
        return {
                title:"",
                description:"",
                editmode:false,
                thumbnail:null,
                short_description:"",
                article:{},
        }
    },
    mounted(){

        if(this.$route.params.id){
            this.editmode=true;
            axios.get('/article/get/'+this.$route.params.id).then((res)=>{
                this.article=res.data.article;
                this.title=this.article.title;
                this.short_description=this.article.short_description;
                this.description=this.article.description;
            });
        }
        else {
            this.editmode=false;
        }
        console.log(this.$route.params.id);
    },
    methods:{
        goBack(){
            // window.history.back();
            this.$router.push('/articles');
        },
             openNotification(position = null, color,type="New",message=null) {
                const noti = this.$vs.notification({
                    duration:3000,
                    color,
                    position,
                    title: type+' Article Success',
                    text: message,
                });
                },
        onSubmit(){
            let formdata= new FormData();
            formdata.append("title",this.title);
            formdata.append("description",this.description);
            formdata.append("thumbnail",this.thumbnail);
            formdata.append("short_description",this.short_description);
            formdata.append("user_id",user.id);
            let url="/article/post";
            if(this.editmode){
            formdata.append("id",this.article.id);
            url="/article/update";
            }
            axios.post(url,formdata).then((res)=>{
                 if(this.editmode){
                    this.openNotification('top-right', 'primary',"Update","This article has been updated");
                 }
                 else {
                      this.openNotification('top-right', 'success',"New","This article has been created");
                 }
                      setTimeout(() => {
                          this.$router.push('/articles');
                      }, 2000)
            });
        }
    }
}
</script>

<style>

</style>
