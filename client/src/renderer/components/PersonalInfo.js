import React, { useState } from 'react'

function PersonalInfo() {
    const [firstName, setFirstName] = useState('')
    const [secondName, setSecondName] = useState('')
    const [address, setAddress] = useState('')
    const [date, setDate] = useState('')
    const [email, setEmail] = useState('')
    const [phone, setPhone] = useState('')

    const HandleFirstName = (name) => {
        setFirstName(name)
    }

    const HandleSecondName = (name) => {
        setSecondName(name)
    }

    const HandleDateOfBirth = (name) => {
        setDate(name)
    }

    const HandlePhone = (phone) => {
        setPhone(phone)
    }

    const HandleAddress = (address) => {
        setAddress(address)
    }

    const HandleEmail = (email) => {
        setEmail(email)
    }
  return (
    <div className='component'>
        <h3>Personal information</h3>
        <div className='container flex-col gap-[16px] max-w-[676px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>First Name*</h4>
                        <input type='text' onChange={(e) => HandleFirstName(e.target.value)}/>
                    </div>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Second Name*</h4>
                        <input type='text' onChange={(e) => HandleSecondName(e.target.value)}/>
                    </div>
                </div>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Date of birth*</h4>
                        <input type='date' onChange={(e) => HandleDateOfBirth(e.target.value)}/>
                    </div>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Phone number</h4>
                        <input type='text' onChange={(e) => HandlePhone(e.target.value)}/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Email</h4>
                    <input type='text' onChange={(e) => HandleEmail(e.target.value)}/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Address</h4>
                    <input type='text' onChange={(e) => HandleAddress(e.target.value)}/>
                </div>
                <button className='secondary'>Save changes</button>
            </div>
    </div>
  )
}

export default PersonalInfo