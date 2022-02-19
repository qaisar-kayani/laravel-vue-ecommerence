<template lang="">
    <div>
         <div class="min-h-100 p-0 p-sm-6 d-flex align-items-stretch">
        <div class="card w-25x flex-grow-1 flex-sm-grow-0 m-sm-auto">
            <form @submit.prevent="login">
            <div class="card-body p-sm-5 m-sm-3 flex-grow-0">
                <h1 class="mb-0 fs-3">Sign In</h1>
                <div class="fs-exact-14 text-muted mt-2 pt-1 mb-5 pb-2">Log in to your account to continue.</div>
                <div class="mb-4"><label class="form-label">Email Address</label>
                        <input type="email"
                        class="form-control form-control-lg" v-model="form.email" /></div>
                <div class="mb-4"><label class="form-label">Password</label>
                <input type="password"
                        class="form-control form-control-lg" v-model="form.password" /></div>
                <div class="mb-4 row py-2 flex-wrap">
                    <div class="col-auto me-auto"><label class="form-check mb-0">
                        <input type="checkbox"
                                class="form-check-input" /><span class="form-check-label">Remember me</span></label>
                    </div>
                    <!-- <div class="col-auto d-flex align-items-center"><a href="auth-forgot-password.html">Forgot
                            password?</a></div> -->
                </div>
                <div><button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button></div>
            </div>
           </form>
        </div>
    </div>
    </div>
</template>
<script>
// import helper from "../../mixins/helper";
export default {
  // mixins:[helper],
  mounted() {
   
  },

  data() {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    login() {
      this.$store.dispatch("fetchAuthLogin", this.form).then((res) => {
        if (res.status == 200) {
          // this.$router.push({ name: "dashboard" });
           this.$router.go({ name: "dashboard" });

          this.$toast.success("Login Successfully");
        }
      });
    },
  },
};
</script>
<style lang="">
</style>