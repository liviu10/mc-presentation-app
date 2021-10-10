function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  // URL route for the home page
  { path: '/', name: 'home-page', component: page('user/index.vue') },

  // URL route for the schedule appointment page
  { path: '/schedule-appointment', name: 'schedule-appointment', component: page('user/schedule-appointment/index.vue') },
  { path: '/schedule-appointment/start-questionnaire', name: 'schedule-appointment.index', component: page('user/schedule-appointment/start-questionnaire/index.vue') },

  // URL route for main blog categories page
  { path: '/blog', name: 'blog', component: page('user/blog/index.vue') },

  // URL routes for the written blog pages
  { path: '/blog/article', name: 'article.index', component: page('user/blog/article/index.vue') },
  { path: '/blog/article/subcategory/:subcategoryTitle', name: 'article.subcategory.index', component: page('user/blog/article/subcategory/index.vue') },
  { path: '/blog/article/view/:id', name: 'article.view.index', component: page('user/blog/article/view/index.vue') },

  // URL routes for the audio blog pages
  { path: '/blog/audio', name: 'audio.index', component: page('user/blog/audio/index.vue') },
  { path: '/blog/audio/subcategory/:subcategoryTitle', name: 'audio.subcategory.index', component: page('user/blog/audio/subcategory/index.vue') },
  { path: '/blog/audio/view/:articleTitle', name: 'audio.view.index', component: page('user/blog/audio/view/index.vue') },

  // URL routes for the video blog pages
  { path: '/blog/video', name: 'video.index', component: page('user/blog/video/index.vue') },
  { path: '/blog/video/subcategory/:subcategoryTitle', name: 'video.subcategory.index', component: page('user/blog/video/subcategory/index.vue') },
  { path: '/blog/video/view/:articleTitle', name: 'video.view.index', component: page('user/blog/video/view/index.vue') },

  // URL route for the about me page
  { path: '/about-me', name: 'about-me', component: page('user/about-me/index.vue') },

  // URL route for the contact me page
  { path: '/contact-me', name: 'contact-me', component: page('user/contact-me/index.vue') },

  // URL route for the terms and conditions page
  { path: '/terms-and-conditions', name: 'terms-and-conditions', component: page('user/terms-and-conditions/index.vue') },

  // URL routes for the Administration Panel of the Web Application
  { path: '/admin', name: 'login', component: page('auth/login.vue') },
  { path: '/admin/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/admin/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/admin/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/admin/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
  { path: '/admin/home', name: 'admin-home-page', component: page('admin/index.vue') },

  {
    path: '/settings',
    name: 'profile-settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  // URL routes for different HTTP errors
  { path: '*', component: page('errors/404.vue') }

  // Old URL routes for the login and register system
  // { path: '', name: 'home', component: page('home.vue') },
  // { path: '/login', name: 'login', component: page('auth/login.vue') },
  // { path: '/register', name: 'register', component: page('auth/register.vue') },
  // { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  // { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  // { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  // { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
]
