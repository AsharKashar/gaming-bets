<template>
  <!-- SignIn Area Start -->
  <div
    id="signin"
    class="modal fade login-modal sign-in"
    tabindex="-1"
    role="dialog"
    aria-labelledby="signin"
    aria-hidden="true"
  >
    <div
      class="modal-dialog modal-dialog-centered "
      role="document"
    >
      <div class="modal-content">
        <div class="modal-body">
          <div class="header-area">
            <h4 class="title">
              Welcome
            </h4>
          </div>
          <div class="form-area">
            <form
              action=""
              method="POST"
            >
              <!-- {{csrf_field()}} -->
              <div class="form-group">
                <label for="input-name">Username*</label>
                <input
                  id="input-name"
                  type="text"
                  name="name"
                  class="input-field"
                  placeholder="Enter your Username"
                  required
                >
              </div>
              <hr>
              <div class="form-group">
                <label for="input-email">E-mail*</label>
                <input
                  id="input-email"
                  type="email"
                  name="email"
                  class="input-field"
                  placeholder="example@gmail.com"
                  required
                >
              </div>
              <hr>
              <div class="form-group">
                <label for="input-password">Password*</label>
                <input
                  id="input-password"
                  type="password"
                  name="password"
                  class="input-field"
                  placeholder="&nbsp;Enter your password"
                  required
                >
              </div>
              <hr>
              <div class="form-group">
                <label for="input-con-password">Confirm password**</label>
                <input
                  id="input-con-password"
                  type="password"
                  name="password_confirmation"
                  class="input-field"
                  placeholder="Re-Enter your Password"
                  required
                >
              </div>
              <hr>
              <input
                id="role"
                type="hidden"
                name="role"
                value="user"
              >

              <!-- <div class="form-group">
                            <div class="check-group">
                                <input type="checkbox" class="check-box-field" name="terms" id="input-terms" checked required>
                                <label for="input-terms">
                                    I agree with <a href="/terms-conditions">terms and Conditions</a> and  <a href="/terms-conditions-details">privacy policy</a>
                                </label>
                            </div>
                        </div>-->
              <div
                class="form-group fbtn"
                style=""
              >
                <button
                  type="submit"
                  class="mybtn2"
                >
                  Sign up
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- SignIn Area End -->
</template>
