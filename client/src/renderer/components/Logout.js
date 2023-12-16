import React from 'react'
import AlertIcon from '../assets/icons/alert-hexagon.svg'
import { useNavigate } from 'react-router-dom'

function Logout({setLogout}) {
  const navigate = useNavigate()
  return (
    <div className='modal-bg' onClick={() => setLogout(false)}>
        <div className='modal'>
            <div className='container flex-col gap-[16px]'>
                <img src={AlertIcon} className='mx-auto'/>
                <h2>Are you sure to log out?</h2>
            </div>
            <h4 className='text-base'>Just a double-check before you go</h4>
            <div className='container gap-[8px]'>
                <button className='secondary w-[188px]' onClick={() => setLogout(false)}>Cancel</button>
                <button className='w-[188px]' onClick={() => navigate('/')}>Log out</button>
            </div>
        </div>
    </div>
  )
}

export default Logout