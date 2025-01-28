import axios from "axios";
import { sayHello } from "./my.js";
import { readFile } from './filehasher.js';

window.axios = axios;
window.sayHello = sayHello;
window.readFile = readFile;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
