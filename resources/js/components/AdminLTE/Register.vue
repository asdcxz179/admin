<template>
	<div>
		<div class="register-box">
		  <div class="register-logo">
		   <b>Admin</b>LTE
		  </div>

		  <div class="card">
		    <div class="card-body register-card-body">
		      <p class="login-box-msg">{{$t('register-page.title')}}</p>
		      <select v-on:change="loadLanguageAsync" v-model="getLang">
		      	<option v-for="(name,lang) in this.$parent.language_type" :value="lang">{{name}}</option>
		      </select>
		      <form v-on:submit="register">
		        <div class="input-group mb-3">
		          <input type="text" class="form-control" name="username" :placeholder="$t('common.account')">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-user"></span>
		            </div>
		          </div>
		        </div>
		        <div class="input-group mb-3">
		          <input type="email" class="form-control" name="email" :placeholder="$t('common.email')">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-envelope"></span>
		            </div>
		          </div>
		        </div>
		        <div class="input-group mb-3">
		          <input type="text" class="form-control" name="name" :placeholder="$t('common.name')">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-user"></span>
		            </div>
		          </div>
		        </div>
		        <div class="input-group mb-3">
		          <input type="password" class="form-control" name="password" :placeholder="$t('common.password')">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-lock"></span>
		            </div>
		          </div>
		        </div>
		        <div class="input-group mb-3">
		          <input type="password" class="form-control" name="password_confirmation" :placeholder="$t('common.password_confirm')">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-lock"></span>
		            </div>
		          </div>
		        </div>
		        <div class="row">
		          <!-- <div class="col-8">
		            <div class="icheck-primary">
		              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
		              <label for="agreeTerms">
		               I agree to the <a href="#">terms</a>
		              </label>
		            </div>
		          </div> -->
		          <div class="col-6">
					<router-link :to="'login'" :class="['btn','btn-primary','btn-block']">
						{{$t('common.login')}}
					</router-link>
				</div>
		          <div class="col-6">
		            <button type="submit" class="btn btn-primary btn-block">{{$t('common.register')}}</button>
		          </div>
		          <!-- /.col -->
		        </div>
		      </form>
		      <!-- <a href="login.html" class="text-center">I already have a membership</a> -->
		    </div>
		  </div><!-- /.card -->
		</div>
	</div>
</template>
<script type="text/javascript">
	export default {
		data(){
			return {getLang:this.$parent.getLang}
		},
		methods:{
			register:function(e){
				e.preventDefault();
				var Data = new FormData(e.target);
				axios.post('/api/v1/Register',Data).then(function(response){
					console.log(response);
				}).catch();
			},
			loadLanguageAsync:function(e){
				this.$store.commit('LANGUAGE', e.target.value);
    			this.$parent.loadLanguageAsync();
			}
		},
        mounted:function (){
            $('body').addClass('hold-transition register-page');
        }
    }
</script>