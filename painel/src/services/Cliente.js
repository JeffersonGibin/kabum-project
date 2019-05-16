
import Service from './Service'

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
    listAll: (id)  => {
        return Service.get("./listaCliente/"+id)
    }
}