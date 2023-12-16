import React, { useState } from 'react'

function ChangePassword() {
    const [password, setPassword] = useState('')
    const [confirmPassword, setConfirmPassword] = useState('')

    const HandlePassword = (password) => {
        setPassword(password)
    }

    const HandleConfirmPassword = (password) => {
        setConfirmPassword(password)
    }
  return (
    <div className='component max-w-[676px]'>
        <div className='container flex-col'>
            <h4 className='input-header'>Password*</h4>
            <input type='password' onChange={(e) => HandlePassword(e.target.value)}/>
        </div>
        <div className='container flex-col'>
            <h4 className='input-header'>Confirm password*</h4>
            <input type='password' onChange={(e) => HandleConfirmPassword(e.target.value)}/>
        </div> 
        <button>Save changes</button>       
    </div>
  )
}

export default ChangePassword