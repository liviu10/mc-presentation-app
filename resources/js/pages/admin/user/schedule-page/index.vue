<template>
  <div class="row">
    <div class="col-lg-12 m-auto">
      <div class="lv-pg-admin-schedule">
        <div class="lv-pg-admin-schedule-header">
          <h1>USER SCHEDULE APPOINTMENT</h1>
        </div>
        <div class="lv-pg-admin-schedule-body">
          <h1>BODY HERE</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminUserScheduleAppointment',
  middleware: 'auth',
  metaInfo () {
    return { title: 'Admin - User Schedule Appointment Page' }
  }
}
</script>
