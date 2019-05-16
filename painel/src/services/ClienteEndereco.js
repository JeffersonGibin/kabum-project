
import Service from './Service'

export default  {
    cadEnderecoCliente(inputs){
        return Service.post("./cadEnderecoCliente", inputs)
    },
    removerEnderecoCliente(id){
        return Service.put("./removerEnderecoCliente/"+id)
    },
    editarEnderecoCliente(id, data){
        return Service.put("./editClienteEndereco/"+id, data)
    },    
    listAll: (id)  => {
        return Service.get("./listaEnderecoCliente/"+id)
    }
}