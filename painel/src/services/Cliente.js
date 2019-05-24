import HTTP from './HTTP'

export default {
    cadCliente: (inputs) => HTTP.post("./cadCliente", inputs),
    removerCliente: (id) => HTTP.put("./removeCliente/" + id),
    editarCliente: (id, data) => HTTP.put("./editCliente/" + id, data),
    listAll: (id) => HTTP.get("./listaCliente/" + id)
}