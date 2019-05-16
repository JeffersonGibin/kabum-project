import Service from './Service'

export default  {
    efetuarLogin: (user, password)  => {

        return Service.post("./login", {
            login: user,
            senha: password
        })
    }
}