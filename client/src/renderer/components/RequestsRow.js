import React from 'react'
import TrashIcon from '../assets/icons/trash-03.svg'
import { Socket } from '..'
import { error } from 'console'

const singularType = (str) => {
  if(str[str.length-1] === 's'){
    return str.slice(0,str.length-1)
  }
  return str
}

function RequestsRow({user,type,deleted}) {
  const admin = JSON.parse(localStorage.getItem('user'))
  const HandleDelete = () => {
    Socket.request("DELETE","admin",`${singularType(type)}Delete/`,`${user.guid}:${admin.token}`)
    .then(() => {alert(`User ${user.name} ${user.surname} deleted!`);deleted(user.guid)})
    .catch((error) => {alert(`User ${user.name} ${user.surname} deleted!`);deleted(user.guid)})
  }
  return (
    <div className='table-row'>
            <div className='w-[70px]'>
              <h4>{user.guid?.slice(0,5)}...</h4>
            </div>
            <div className='w-[130px]'>
              <h4>{`${user.name} ${user.surname}`.slice(0,10)}...</h4>
            </div>
            <div className='w-[110px]'>
              <h4>{user.birth?.slice(0,10)}</h4>
            </div>
            <div className='w-[140px]'>
              <h4>{user.email?.slice(0,12)}...</h4>
            </div>
            <div className='w-[140px]'>
              <h4>{user.address?.slice(0,10)}...</h4>
            </div>
            {
              (type === "donors" || type === "patients") &&
              <div className='w-[60px]'>
                  <h4 className='mx-auto'>{`${user.blood_type}${user.blood_rh}`}</h4>
              </div>
            }
            <div className='w-[100px] container gap-[24px] cursor-pointer'>
              <img src={TrashIcon} className='w-[30px] mx-auto cursor-pointer' onClick={() => HandleDelete()}/>
            </div>
</div>
  )
}

export default RequestsRow