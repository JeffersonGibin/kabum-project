import axios from 'axios'
import LocalStorage from '../utils/LocalStorage'

const URL = "http://142.93.48.179/webservice/api/"

let data = LocalStorage.get("SESSION_KABUM") || {token: ''};

export default axios.create({
    baseURL: URL,
    headers: {'Authorization': data.token}
});