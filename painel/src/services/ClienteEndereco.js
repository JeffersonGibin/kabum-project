import HTTP from './HTTP'

export default {
    cadEnderecoCliente: (data) =>  HTTP.post("./cadEnderecoCliente", data),
    removerEnderecoCliente: (id) =>  HTTP.put("./removerEnderecoCliente/" + id),
    editarEnderecoCliente: (id, data) =>  HTTP.put("./editClienteEndereco/" + id, data),
    listAll: (id) =>  HTTP.get("./listaEnderecoCliente/" + id)
}