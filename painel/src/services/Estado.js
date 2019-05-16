
import Service from './Service'

export default  {
    listAll: ()  => {
        return Service.get("./listaEstado")
    }
}