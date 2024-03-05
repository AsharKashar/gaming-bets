<template>
  <!-- Login Area Start -->
  <div
    id="login"
    class="modal fade login-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="login"
    aria-hidden="true"
  >
    <div
      class="modal-dialog modal-dialog-centered"
      role="document"
    >
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-area">
            <form
              id="loginForm"
              action="#"
            >
              <div
                class="form-group"
                style="border-bottom: 1px solid #a1afd3;"
              >
                <label for="login-input-email">Email*</label>
                <input
                  id="login-input-email"
                  type="email"
                  name="email"
                  class="input-field"
                  placeholder="example@gmail.com"
                >
              </div>
              <div
                class="form-group"
                style="border-bottom: 1px solid #a1afd3;"
              >
                <label for="login-input-password">Password*</label>
                <input
                  id="login-input-password"
                  type="password"
                  name="password"
                  class="input-field"
                  placeholder="Enter your password"
                >
              </div>
              <div class="form-group">
                <div class="box">
                  <div class="left">
                    <p>
                      Not a member?<br>
                      <a
                        data-toggle="modal"
                        data-target="#signin"
                        data-dismiss="modal"
                        style="color:#bf1438;cursor:pointer"
                      >Create account </a>
                    </p>
                  </div>
                  <div
                    class="left"
                    style="display:none"
                  >
                    <input
                      id="input-save-password"
                      type="checkbox"
                      class="check-box-field"
                      checked
                    >
                    <label for="input-save-password">Remember Password</label>
                  </div>
                  <div class="right">
                    <a
                      style="color:#bf1438"
                      href=""
                    >
                      Forgotten Password
                    </a>
                  </div>
                </div>
              </div>
              <div
                id="loginMsg"
                class="alert alert-danger"
                style="display: none"
                role="alert"
              />
              <div class="form-group">
                <button
                  id="loginBtn"
                  style="margin-left:200px"
                  type="button"
                  class="mybtn5"
                >
                  Log In
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Login Area End -->
</template>
