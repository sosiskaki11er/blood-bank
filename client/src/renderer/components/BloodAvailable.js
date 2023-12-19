import React, { useEffect, useState } from 'react'
import Blood from './Blood'
import { Socket } from '..'

function BloodAvailable({role}) {
  const user = JSON.parse(localStorage.getItem("user"))
  const [blood,setBlood] = useState([])

  useEffect(() => {
    setTimeout(() => {
      if(role === "staff"){
        Socket.request("GET","bloodBank","show/",`${user.staff.hospital_guid}`)
        .then((data) => {setBlood(data.data);console.log(data.data)})
      }
      else if(role === 'doctor'){
        Socket.request("GET","bloodBank","show/",`${user.data.user.hospital_guid}`)
        .then((data) => {setBlood(data.data);console.log(data.data)})
      }
    },100)
  },[])
  return (
    <div className='component'>
        <h3>Blood available:</h3>

        <div className='container flex-wrap gap-[8px]'>
          {
            blood.map(blood => <Blood blood={blood}/>)
          }
        </div>
    </div>
  )
}

export default BloodAvailable