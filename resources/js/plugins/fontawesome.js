import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faUser, faLock, faSignOutAlt, faCog, faBookOpen, faArrowLeft, faFileExport, faEye, faEdit, faTrash,
  faChevronRight, faChevronLeft
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub, faFacebook, faInstagram, faYoutube
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faBookOpen, faArrowLeft, faFileExport, faEye, faEdit, faTrash,
  faFacebook, faInstagram, faYoutube, faChevronRight, faChevronLeft
)

Vue.component('Fa', FontAwesomeIcon)
