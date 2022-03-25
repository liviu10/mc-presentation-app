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
  { path: '/admin/blog', name: 'admin-blog-page', component: page('admin/blog/index.vue') },
  { path: '/admin/contact-me', name: 'admin-contact-me-page', component: page('admin/contact-me/index.vue') },

  { path: '/admin/newsletter', name: 'admin-newsletter-page', component: page('admin/newsletter/index.vue') },
  { path: '/admin/newsletter/campaigns', name: 'admin-newsletter-campaigns-page', component: page('admin/newsletter/campaigns/index.vue') },
  { path: '/admin/newsletter/subscribers', name: 'admin-newsletter-subscribers-page', component: page('admin/newsletter/subscribers/index.vue') },
  { path: '/admin/newsletter/logs', name: 'admin-newsletter-logs-page', component: page('admin/newsletter/logs/index.vue') },

  { path: '/admin/accepted-domains', name: 'admin-accepted-domains-page', component: page('admin/accepted-domains/index.vue') },
  { path: '/admin/documentation', name: 'admin-documentation-page', component: page('admin/documentation/index.vue') },
  { path: '/admin/errors-and-notifications', name: 'admin-errors-and-notifications-page', component: page('admin/errors-and-notifications/index.vue') },
  { path: '/admin/user-list', name: 'admin-user-list-page', component: page('admin/user-list/index.vue') },
  { path: '/admin/profile-settings', name: 'admin-profile-settings-page', component: page('admin/profile-settings/index.vue') },

  // URL routes for different HTTP errors
  { path: '*', component: page('errors/404.vue') }
]
