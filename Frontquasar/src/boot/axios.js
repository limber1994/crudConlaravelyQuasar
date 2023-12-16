import axios from 'axios';

export default ({ app, Vue }) => {
  // Configura la URL base de tu API
  axios.defaults.baseURL = 'https://tu-api.com/api'; // Reemplaza con la URL correcta de tu API

  // Agrega Axios a Vue prototype o al objeto app, dependiendo de tu versión de Quasar
  if (Vue) {
    Vue.prototype.$axios = axios;
  } else {
    app.config.globalProperties.$axios = axios;
  }
};
