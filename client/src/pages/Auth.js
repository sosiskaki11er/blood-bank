import React, { useState } from 'react'
import BloodImg from '../assets/img/svg.png'
import HeartLogo from '../assets/icons/activity-heart.svg'

function Auth() {
    const [auth, setAuth] = useState('')
    const [login, setLogin] = useState('')
    const [password, setPassword] = useState('')
    const [name, setName] = useState('')
    const [headID, setHeadID] = useState('')
    const [address, setAddress] = useState('')

    const HandleLogin = (login) => {
        setLogin(login)
    }

    const HandlePassword = (password) => {
        setPassword(password)
    }

    const HandleName = (name) => {
        setName(name)
    }

    const HandleHeadID = (headID) => {
        setHeadID(headID)
    }

    const HandleAddress = (address) => {
        setAddress(address)
    }
  return (
    <div className="container">
      <img src={BloodImg} alt='bg' className='h-screen'/>

      <div className="container flex-col gap-[60px] m-auto max-w-[406px]">
        <div className='container flex-col gap-[24px]'>
          <div className="container gap-[16px] mx-auto">
            <img src={HeartLogo} alt="logo"/>
            <h1>BloodCare</h1>
          </div>
          <h2 className='max-w-[400px] text-center'>Connecting donors and recipients, saving lives.</h2>
        </div>

        {
            (auth === '') && 
            <div className='container flex-col gap-[12px]'>
                <button onClick={() => setAuth('login')}>Log in</button>
                <button onClick={() => setAuth('signup')} className='secondary'>Sign up</button>
            </div>
        }
        
        {
            (auth === 'login') &&
            <div className='container flex-col gap-[16px]'>
                <div className='container flex-col'>
                    <h4>Login*</h4>
                    <input type='text' onChange={(e) => HandleLogin(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4>Password*</h4>
                    <input type='password' onChange={(e) => HandlePassword(e.target.value)}/>
                </div>
                <button onClick={() => setAuth('login')}>Log in</button>
                <div className='flex mx-auto text-sm gap-[6px]'>
                    <span className='text-grey-700'>Already have an account?</span>
                    <span className='text-red-600 underline cursor-pointer' onClick={() => setAuth('signup')}>Sign up</span>
                </div>
            </div>
        }
        
        {
            (auth === 'signup') && 
            <div className='container flex-col gap-[16px]'>
                <div className='flex gap-[16px]'>
                    <div className='container flex-col max-w-[195px]'>
                        <h4>Name*</h4>
                        <input type='text' onChange={(e) => HandleName(e.target.value)}/>
                    </div>
                    <div className='container flex-col max-w-[195px]'>
                        <h4>Head ID*</h4>
                        <input type='text' onChange={(e) => HandleHeadID(e.target.value)}/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4>Address*</h4>
                    <input type='text' onChange={(e) => HandleAddress(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4>Password*</h4>
                    <input type='password' onChange={(e) => HandlePassword(e.target.value)}/>
                </div>
                <button onClick={() => setAuth('login')}>Log in</button>
                <div className='flex mx-auto text-sm gap-[6px]'>
                    <span className='text-grey-700'>Already have an account?</span>
                    <span className='text-red-600 underline cursor-pointer' onClick={() => setAuth('login')}>Sign up</span>
                </div>
            </div>
        }

      </div>
    </div>
  )
}

export default Auth