import React, { useState } from 'react'
import PersonalInfo from './PersonalInfo'
import MedicalInfo from './MedicalInfo'
import BackIcon from '../assets/icons/arrow-narrow-left.svg'
import DonationImg from '../assets/img/blood.png'
import TransfusionImg from '../assets/img/transfusion.png'

function EditPrescription({setSubpage,subpage,role}) {
  const appointment = JSON.parse(localStorage.getItem("edit-appointment"))
  localStorage.removeItem("edit-appointment")
  console.log(appointment)
  const [firstName, setFirstName] = useState('')
  const [secondName, setSecondName] = useState('')
  const [address, setAddress] = useState('')
  const [date, setDate] = useState('')
  const [email, setEmail] = useState('')
  const [phone, setPhone] = useState('')
  const [action, setAction] = useState('donation')

  return (
    <div className='subpage'>
      <button className='tertiary mr-auto flex gap-[8px]' onClick={() => setSubpage('prescriptions')}>
        <img src={BackIcon} className='my-auto'/>
        <h3>Go back</h3>
      </button>
     
        <div className='component'>
            <h3>Action to be performed</h3>
            <div className='container gap-[20px]'>
                <div className={role === "doctor"?'action active':'action'} onClick={() => setAction('donation')}>
                    <img src={DonationImg}/>
                    <h3 className='text-lg my-auto'>Blood Infusion</h3>
                </div>
                <div className={role=== "staff"?'action active':'action'} onClick={() => setAction('transfusion')}>
                    <img src={TransfusionImg}/>
                    <h3 className='text-lg my-auto'>Blood transfusion</h3>
                </div>
            </div>
        </div>
      
      <div className='component'>
        <h3>Personal information</h3>
        <div className='container flex-col gap-[16px] max-w-[676px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>First Name*</h4>
                        <input type='text'/>
                    </div>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Second Name*</h4>
                        <input type='text'/>
                    </div>
                </div>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Date of birth*</h4>
                        <input type='date'/>
                    </div>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Phone number</h4>
                        <input type='text'/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Email</h4>
                    <input type='text'/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Address</h4>
                    <input type='text'/>
                </div>
            </div>
      </div>
      <div className='component max-w-[684px]'>
          <h3>Medical information</h3>
          <div className='container flex-col gap-[24px]'>
                <div className='flex gap-[12px] justify-between'>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Blood type</h4>
                        <select>
                            <option>A</option>
                            <option>B</option>
                            <option>O</option>
                            <option>AB</option>
                        </select>
                    </div>
                    <div className='container flex-col flex-grow-[1] max-w-[332px]'>
                        <h4 className='input-header'>Rhesus</h4>
                        <select>
                            <option>+</option>
                            <option>-</option>
                        </select>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Diseases</h4>
                    <input type='text'/>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Amount of Blood (ml)</h4>
                    <input type='text'/>
                </div>
                {(role === 'doctor') && <button className='secondary'>Save changes</button>}
                {(role === 'staff') && 
                    <div className='container flex-col gap-[16px]'>
                        <button>Accept</button>
                        <button className='secondary'>Reject</button>
                    </div>
                }
                
          </div>
        </div>
    </div>
  )
}

export default EditPrescription