@extends('layouts.auth')

@section('content')

<div class="page-content page-auth" id="register">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login justify-content-center">
            <div class="col-lg-4">
              <h2>
                Memulai untuk jual beli <br />
                dengan cara terbaru
              </h2>
              <form method="POST" action="{{ route('register') }}" class="mt-3">
                @csrf
                <div class="form-group">
                  <label>Full Name</label>
                  <input 
                    v-model="name"
                    id="name" 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autocomplete="name" 
                    autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Email Address</label>
                  <input 
                    v-model="email"
                    @change="checkEmail()"
                    id="email" 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    :class="{'is-invalid' : this.email_unavailable}"
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input 
                    id="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" 
                    required 
                    autocomplete="new-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
                <div class="form-group">
                  <label>Konfirmasi Password</label>
                  <input 
                    id="password_confirmation" 
                    type="password" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password">
                      @error('password_confirmation')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
                <div class="form-group">
                  <label>Store</label>
                  <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="is_store_open"
                      id="openStoreTrue"
                      v-model="is_store_open"
                      :value="true"
                    />
                    <label for="openStoreTrue" class="custom-control-label">
                      Iya, boleh
                    </label>
                  </div>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="is_store_open"
                      id="openStoreFalse"
                      v-model="is_store_open"
                      :value="false"
                    />
                    <label for="openStoreFalse" class="custom-control-label">
                      Engga, Makasih
                    </label>
                  </div>
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label>Nama Toko</label>
                  <input 
                    v-model="store_name"
                    id="store_name" 
                    type="text" 
                    class="form-control @error('store_name') is-invalid @enderror" 
                    name="store_name" 
                    value="{{ old('store_name') }}" 
                    required 
                    autocomplete 
                    autofocus>
                    @error('store_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label>Kategori</label>
                  <select name="kategori" class="form-control">
                    <option value="" disabled>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <button 
                  type="submit" 
                  class="btn btn-success btn-block mt-2"
                  :disabled="this.email_unavailable">
                  Sign In to My Account
                </button>
                <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                  Back to Sign In
                </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="container" style="display: none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input
                                  v-model="email"
                                   
                                  id="email" 
                                  type="email" 
                                  class="form-control @error('email') is-invalid @enderror" 
                                  name="email" 
                                  value="{{ old('email') }}" 
                                  required 
                                  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
         
        },
        methods:{
          checkEmail: function () {
            var self = this;
            axios.get('{{ route('api-register-check') }}' , {
              params: {
                email: self.email
              }
            })

              .then(function (response) {
                            console.log(response);
                if(response.data == 'Available'){
                  self.$toasted.show(
                    "Email anda tersedia! Silakan lanjutkan langkah selanjutnya!",
                    {
                      position: "top-center",
                      className: "rounded",
                      duration: 1000,
                    }
                  );
                  self.email_unavailable = false;
                }else{
                   self.$toasted.error(
                    "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                    {
                      position: "top-center",
                      className: "rounded",
                      duration: 1000,
                    }
                  );
                  self.email_unavailable = true;
                }
                
                // handle success
                console.log(response);
              });
          }
        },
        data() {
          return {
            name: "",
            email: "",
            is_store_open: true,
            store_name: "",
            email_unavailable: false
          }
        },
      });
    </script>
@endpush
