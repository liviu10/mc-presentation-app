function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  // URL route for the User Login and Registration system
  { path: '/login', name: 'user.auth.login', component: page('user/auth/login.vue') },
  { path: '/register', name: 'user.auth.register', component: page('user/auth/register.vue') },
  { path: '/password/reset', name: 'user.auth.password.request', component: page('user/auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'user.auth.password.reset', component: page('user/auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'user.auth.verification.verify', component: page('user/auth/verification/verify.vue') },
  { path: '/email/resend', name: 'user.auth.verification.resend', component: page('user/auth/verification/resend.vue') },

  // URL route for the home page
  { path: '/', name: 'home-page', component: page('user/index.vue') },

  // URL route for the schedule appointment page
  { path: '/schedule-appointment', name: 'schedule-appointment', component: page('user/schedule-appointment/index.vue') },
  { path: '/schedule-appointment/questionnaire/:id', name: 'schedule-appointment.index', component: page('user/schedule-appointment/questionnaire/index.vue') },
  { path: '/schedule-appointment/booking', name: 'booking.index', component: page('user/schedule-appointment/booking/index.vue') },

  // URL route for main blog categories page
  { path: '/blog', name: 'blog', component: page('user/blog/index.vue') },

  // URL routes for the written blog pages
  { path: '/blog/article', name: 'article.index', component: page('user/blog/article/index.vue') },
  { path: '/blog/subcategory/:id/all-written-articles', name: 'article.subcategory.index', component: page('user/blog/article/subcategory/index.vue') },
  { path: '/blog/article/view/:id', name: 'article.view.index', component: page('user/blog/article/view/index.vue') },

  // URL routes for the audio blog pages
  { path: '/blog/audio', name: 'audio.index', component: page('user/blog/audio/index.vue') },
  { path: '/blog/subcategory/:id/all-audio-articles', name: 'audio.subcategory.index', component: page('user/blog/audio/subcategory/index.vue') },
  { path: '/blog/audio/view/:id', name: 'audio.view.index', component: page('user/blog/audio/view/index.vue') },

  // URL routes for the video blog pages
  { path: '/blog/video', name: 'video.index', component: page('user/blog/video/index.vue') },
  { path: '/blog/subcategory/:id/all-video-articles', name: 'video.subcategory.index', component: page('user/blog/video/subcategory/index.vue') },
  { path: '/blog/video/view/:id', name: 'video.view.index', component: page('user/blog/video/view/index.vue') },

  // URL route for the about me page
  { path: '/about-me', name: 'about-me', component: page('user/about-me/index.vue') },

  // URL route for the contact me page
  { path: '/contact-me', name: 'contact-me', component: page('user/contact-me/index.vue') },

  // URL route for the terms and conditions page
  { path: '/terms-and-conditions', name: 'terms-and-conditions', component: page('user/terms-and-conditions/index.vue') },

  // URL routes for the Administration Panel of the Web Application
  { path: '/admin/home', name: 'admin-home-page', component: page('admin/index.vue') },

  // URL routes for admin user home page and sections
  { path: '/admin/user/home-page', name: 'admin-user-home-page', component: page('admin/user/home-page/index.vue') },
  { path: '/admin/user/home-page/section/carousel', name: 'admin-user-home-page-section-carousel', component: page('admin/user/home-page/section/carousel/index.vue') },
  { path: '/admin/user/home-page/section/jumbotron', name: 'admin-user-home-page-section-jumbotron', component: page('admin/user/home-page/section/jumbotron/index.vue') },
  { path: '/admin/user/home-page/section/newsletter', name: 'admin-user-home-page-section-newsletter', component: page('admin/user/home-page/section/newsletter/index.vue') },
  { path: '/admin/user/home-page/section/testimonials', name: 'admin-user-home-page-section-testimonials', component: page('admin/user/home-page/section/testimonials/index.vue') },
  { path: '/admin/user/home-page/section/footer', name: 'admin-user-home-page-section-footer', component: page('admin/user/home-page/section/footer/index.vue') },
  // URL routes for admin blog page and sections
  { path: '/admin/user/blog-page', name: 'admin-user-blog-page', component: page('admin/user/blog-page/index.vue') },
  { path: '/admin/user/blog-page/new-article', name: 'admin-user-blog-page-new-article', component: page('admin/user/blog-page/articles/new-article.vue') },
  { path: '/admin/user/blog-page/edit-article', name: 'admin-user-blog-page-edit-article', component: page('admin/user/blog-page/articles/edit-article.vue') },
  { path: '/admin/user/blog-page/comments', name: 'admin-user-blog-page-comments', component: page('admin/user/blog-page/articles/comments.vue') },
  // URL routes for admin schedule page and sections
  { path: '/admin/user/schedule-page', name: 'admin-user-schedule-page', component: page('admin/user/schedule-page/index.vue') },
  // URL routes for admin about me page and sections
  { path: '/admin/user/about-page', name: 'admin-user-about-page', component: page('admin/user/about-page/index.vue') },
  // URL routes for admin contact me page and sections
  { path: '/admin/user/contact-page', name: 'admin-user-contact-page', component: page('admin/user/contact-page/index.vue') },

  // URL routes for the application settings
  { path: '/admin/settings/application', name: 'admin-settings-application-page', component: page('admin/settings/application/index.vue') },
  // URL routes for the application logs
  { path: '/admin/settings/logs', name: 'admin-settings-logs-page', component: page('admin/settings/logs/index.vue') },
  // URL route for the application documentation
  { path: '/admin/settings/documentation', name: 'admin-settings-documentation-page', component: page('admin/settings/documentation/index.vue') },

  // URL route for the user profile settings
  { path: '/admin/profile-settings', name: 'admin-profile-settings-page', component: page('admin/profile-settings/index.vue') },

  // URL routes for different HTTP errors
  { path: '*', name: 'not-found-page', component: page('errors/404.vue') }
]
