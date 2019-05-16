
import Service from './Service'

export default  {
    listAll: (id)  => {
        return Service.get("./listaCidade/"+id)
    }
}