
import Service from './Service'
import axios from 'axios'

export default  {
    cadCliente(inputs){
        return Service.post("./cadCliente", inputs)
    },
    removerCliente(id){
        return Service.put("./removeCliente/"+id)
    },
    editarCliente(id, data){
        return Service.put("./editCliente/"+id, data)
    },
    listAll: (id, token)  => {
        const URL = "http://142.93.48.179/webservice/api/"

        const http = axios.create({
            baseURL: URL,
            headers: {'Authorization': token}
        });

        return http.get("./listaCliente/"+id)
    }
}