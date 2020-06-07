<template>
	<div>
		<div class="login-box">
			<div class="login-logo">
				<b>Admin</b>LTE
			</div>
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">{{$t('login-page.title')}}</p>
					<form v-on:submit="login">
						<div class="input-group mb-3">
		  					<input type="text" class="form-control" name="username" :placeholder="$t('common.account')">
	  						<div class="input-group-append">
	    						<div class="input-group-text">
	      							<span class="fas fa-envelope"></span>
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
						<div class="row">
		  					<!-- <div class="col-8">
		    					<div class="icheck-primary">
		      						<input type="checkbox" id="remember">
		      						<label for="remember">
		        						Remember Me
		      						</label>
		    					</div>
		  					</div> -->
		  					<div class="col-6">
		  						<router-link :to="'register'" :class="['btn','btn-primary','btn-block']">
		  							{{$t('common.register')}}
		  						</router-link>
		  					</div>
		  					<div class="col-6">
		    					<button type="submit" class="btn btn-primary btn-block">{{$t('common.login')}}</button>
		  					</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		
		methods:{
			login:function(e){
				e.preventDefault();
				var Data = new FormData(e.target);
				axios.post('/api/v1/Login',Data).then(function(response){
					console.log(response);
				}).catch();
			}
		},
        mounted() {
            $('body').addClass('hold-transition login-page');
        }
    }

</script>
