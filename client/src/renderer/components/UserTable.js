import React, { useEffect, useState } from 'react'
import ArrowsIcon from '../assets/icons/Arrows.svg'
import RequestsRow from './RequestsRow'
import { Socket } from '..'

const convertString = (str) => {
  if(str[str.length - 1] === 's'){
    return "" + str[0].toUpperCase() + str.slice(1,str.length-1)+"'s"
  }
  else{
    return "" + str[0].toUpperCase() + str.slice(1,str.length) +"'s"
  }
}

function UserTable({type}) {
  console.log(type)
  const user = JSON.parse(localStorage.getItem('user'))
  const [users, setUsers] = useState([])
  const [more, setMore] = useState(false)
  const [deleted,setDeleted] = useState()
  let timeOut
  switch(type){
    case "donors":{
      timeOut = 0
      break;
    }
    case 'patients':{
      timeOut = 500
      break;
    }
    case 'doctors':{
      timeOut = 1000
      break;
    }
    case "staff": {
      timeOut = 1500
      break;
    }
  }
  useEffect(() => {
    setTimeout(() => {
      Socket.request("GET","admin",`${type}Index`,`:${user.token}`).then(data => {setUsers(data[type]  || data.data);console.log(data[type]  || data.data);if(data.data?.length || data[type].length < 5){setMore(true)}})
    },timeOut)
  },[deleted])
  return (
    <div className='component'>
        <h3>{type[0].toUpperCase()}{type.slice(1)}</h3>
        <div className='table'>
            <div className='table-header'>
            <div className='w-[70px]'>
            <h4>ID</h4>
            </div>
            <div className='w-[130px]'>
            <h4>{convertString(type)} name</h4>
            </div>
            <div className='w-[110px]'>
            <h4>Birth</h4>
            </div>
            <div className='w-[140px]'>
            <h4>Email</h4>
            </div>
            <div className='w-[140px]'>
            <h4>Address</h4>
            </div>
            {
              (type == "donors" || type == 'patients') &&
              <div className='w-[60px]'>
                <h4>Blood</h4>
              </div>
            }
            <div className='w-[60px]'>
            <h4>Action</h4>
            </div>
            </div>
            {
              more ? 
              users.map(user => <RequestsRow user={user} type={type} deleted={setDeleted}/>) :
              users?.slice(0,5).map(user => <RequestsRow user={user} type={type} deleted={setDeleted}/>)
            }
            {
              !more &&
              <button onClick={() => setMore(users.length)}>Show more</button>
            }
        </div>
    </div>
  )
}

export default UserTable