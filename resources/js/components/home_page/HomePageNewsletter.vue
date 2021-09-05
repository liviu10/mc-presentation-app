<template>
  <div class="container lv-container-newsletter">
    <form action="/" method="POST">
      <div class="row">
        <div class="col col-5">
          <input type="text" class="form-control" placeholder="Numele si Prenumele tau" name="full_name" required>
        </div>
        <div class="col col-5">
          <input type="email" class="form-control" placeholder="Adresa ta de e-mail" name="email" required>
        </div>
        <div class="col col-2">
          <button type="submit" class="btn btn-success">
            ABONEAZA-TE!
          </button>
        </div>
      </div>
      <div class="row">
        <div class="form-check">
          <input id="flexCheckChecked" class="form-check-input" type="checkbox" value="" name="privacy_policy">
          <label class="form-check-label lead" for="flexCheckChecked">
            Sunt de acord cu
            <a href="#">termenii si conditiile</a>
          </label>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'HomePageNewsletter',
  components: {},
  data: function () {
    return {}
  },
  computed: {}
}
</script>
