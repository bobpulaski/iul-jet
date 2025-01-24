import axios from "axios";
// import md5File from "md5-file";

window.axios = axios;
// window.md5File = md5File;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
