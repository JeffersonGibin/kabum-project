import axios from 'axios'
import LocalStorage from '../utils/LocalStorage'

const URL = "http://localhost/kabum/api/"

let data = LocalStorage.get("SESSION_KABUM") || {token: ''};

export default axios.create({
    baseURL: URL,
    headers: {'Authorization': data.token}
});