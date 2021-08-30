function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  // URL route for the home page
  { path: '/', name: 'home', component: page('home.vue') },
  // URL route for the schedule appointment page
  { path: '/schedule-appointment', name: 'schedule-appointment', component: page('scheduled-appointment/index.vue') },
  // URL group routes for the blog pages: written, audio and video articles pages
  {
    path: '/blog',
    name: 'blog',
    component: page('blog/index.vue'),
    children: [
      { path: 'article', name: 'blog.article', component: page('blog/article.vue') },
      { path: 'audio', name: 'blog.audio', component: page('blog/audio.vue') },
      { path: 'video', name: 'blog.video', component: page('blog/video.vue') }
    ]
  },
  // URL route for the about me page
  { path: '/about-me', name: 'about-me', component: page('about-me/index.vue') },
  // URL route for the contact me page
  { path: '/contact-me', name: 'contact-me', component: page('contact-me/index.vue') },

  // URL routes for the login and registration system
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
